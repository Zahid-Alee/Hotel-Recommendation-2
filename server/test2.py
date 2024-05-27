


from flask import Flask, request, jsonify
from flask_cors import CORS
import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.preprocessing import LabelEncoder
from sklearn.ensemble import RandomForestClassifier
from nltk.corpus import stopwords
from nltk.tokenize import word_tokenize
import nltk
from sentence_transformers import SentenceTransformer
import numpy as np

app = Flask(__name__)
CORS(app)  # Enable CORS for all routes

# Load the model and necessary data
hotel_profiles_df = pd.read_csv('hotels_profile.csv')
vectorizer = TfidfVectorizer(stop_words='english')
tag_vectors = vectorizer.fit_transform(hotel_profiles_df['all_tags'])
label_encoder = LabelEncoder()
label_encoder.fit(hotel_profiles_df['sentiment_label'])
rf_model = RandomForestClassifier(n_estimators=100, random_state=42)
rf_model.fit(tag_vectors, hotel_profiles_df['sentiment_label'])
sbert_model = SentenceTransformer('distilbert-base-nli-mean-tokens')

nltk.download('punkt')
nltk.download('stopwords')

@app.route('/recommendation', methods=['POST'])
def recommendation():
    data = request.get_json()
    prompt = data['prompt']
    processed_prompt = preprocess_prompt(prompt)
    prompt_vector = vectorizer.transform([processed_prompt])
    sentiment_label = predict_sentiment(prompt_vector)
    similar_hotels = recommend_hotels(prompt_vector)
    recommended_hotels = similar_hotels[['hotel_name', 'hotel_url', 'avg_rating', 'tags']].to_dict('records')
    return jsonify({'sentiment': sentiment_label, 'recommended_hotels': recommended_hotels})

def preprocess_prompt(prompt):
    stop_words = set(stopwords.words('english'))
    word_tokens = word_tokenize(prompt)
    filtered_sentence = [w for w in word_tokens if not w.lower() in stop_words]
    return ' '.join(filtered_sentence)

def predict_sentiment(prompt_vector):
    sentiment_label_encoded = rf_model.predict(prompt_vector)[0]
    sentiment_label = label_encoder.inverse_transform([sentiment_label_encoded])[0]
    return sentiment_label

def recommend_hotels(prompt_vector, top_n=10):
    similarities = (tag_vectors * prompt_vector.T).toarray().flatten()
    top_indices = np.argsort(similarities)[-top_n:][::-1]
    return hotel_profiles_df.iloc[top_indices]

if __name__ == '__main__':
    app.run(debug=True)

