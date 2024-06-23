# from flask import Flask, request, jsonify
# from flask_cors import CORS
# import pandas as pd
# import numpy as np
# from sklearn.ensemble import RandomForestClassifier
# from sklearn.feature_extraction.text import TfidfVectorizer
# from sklearn.preprocessing import LabelEncoder
# from nltk.corpus import stopwords
# from nltk.tokenize import word_tokenize

# app = Flask(__name__)
# CORS(app)

# # Load hotel profiles data
# hotel_profiles_df = pd.read_csv('hotels_profile.csv')
# hotel_profiles_df['all_tags'] = hotel_profiles_df['tags'].apply(lambda x: ' '.join(x.split('~')))

# # Label encoding for sentiment
# def get_sentiment_label(row):
#     if row['total_positive'] > row['total_negative'] and row['total_positive'] > row['total_neutral']:
#         return 'positive'
#     elif row['total_negative'] > row['total_positive'] and row['total_negative'] > row['total_neutral']:
#         return 'negative'
#     else:
#         return 'neutral'

# hotel_profiles_df['sentiment'] = hotel_profiles_df.apply(get_sentiment_label, axis=1)
# label_encoder = LabelEncoder()
# hotel_profiles_df['sentiment_label'] = label_encoder.fit_transform(hotel_profiles_df['sentiment'])

# # Vectorization
# vectorizer = TfidfVectorizer(stop_words='english')
# tag_vectors = vectorizer.fit_transform(hotel_profiles_df['all_tags'])

# # Model training
# X = tag_vectors
# y = hotel_profiles_df['sentiment_label']
# rf_model = RandomForestClassifier(n_estimators=100, random_state=42)
# rf_model.fit(X, y)

# # Preprocess prompt
# def preprocess_prompt(prompt):
#     stop_words = set(stopwords.words('english'))
#     word_tokens = word_tokenize(prompt)
#     filtered_sentence = [w for w in word_tokens if not w.lower() in stop_words]
#     return ' '.join(filtered_sentence)

# # Recommend hotels
# def recommend_hotels(prompt, top_n=9):
#     processed_prompt = preprocess_prompt(prompt)
#     prompt_vector = vectorizer.transform([processed_prompt])
#     similarities = (tag_vectors * prompt_vector.T).toarray().flatten()
#     top_indices = np.argsort(similarities)[-top_n:][::-1]
#     return hotel_profiles_df.iloc[top_indices][['hotel_name','url', 'hotel_url', 'avg_rating', 'tags']]

# @app.route('/recommend', methods=['POST'])
# def get_recommendations():
#     data = request.get_json()
#     user_prompt = data['prompt']
#     recommended_hotels = recommend_hotels(user_prompt)
#     return jsonify(recommended_hotels.to_dict(orient='records'))

# if __name__ == '__main__':
#     app.run(debug=True)






from flask import Flask, request, jsonify
from flask_cors import CORS
import pandas as pd
import numpy as np
from sklearn.ensemble import RandomForestClassifier
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.preprocessing import LabelEncoder
from nltk.corpus import stopwords
from nltk.tokenize import word_tokenize
from nltk.sentiment.vader import SentimentIntensityAnalyzer
import nltk

# Download necessary NLTK data
nltk.download('vader_lexicon')
nltk.download('punkt')
nltk.download('stopwords')

app = Flask(__name__)
CORS(app)

# Load hotel profiles data
hotel_profiles_df = pd.read_csv('hotels_profile.csv')
hotel_profiles_df['all_tags'] = hotel_profiles_df['tags'].apply(lambda x: ' '.join(x.split('~')))

# Label encoding for sentiment
def get_sentiment_label(row):
    if row['total_positive'] > row['total_negative'] and row['total_positive'] > row['total_neutral']:
        return 'positive'
    elif row['total_negative'] > row['total_positive'] and row['total_negative'] > row['total_neutral']:
        return 'negative'
    else:
        return 'neutral'

hotel_profiles_df['sentiment'] = hotel_profiles_df.apply(get_sentiment_label, axis=1)
label_encoder = LabelEncoder()
hotel_profiles_df['sentiment_label'] = label_encoder.fit_transform(hotel_profiles_df['sentiment'])

# Vectorization
vectorizer = TfidfVectorizer(stop_words='english')
tag_vectors = vectorizer.fit_transform(hotel_profiles_df['all_tags'])

# Model training
X = tag_vectors
y = hotel_profiles_df['sentiment_label']
rf_model = RandomForestClassifier(n_estimators=100, random_state=42)
rf_model.fit(X, y)

# Preprocess prompt
def preprocess_prompt(prompt):
    stop_words = set(stopwords.words('english'))
    word_tokens = word_tokenize(prompt)
    filtered_sentence = [w for w in word_tokens if not w.lower() in stop_words]
    return ' '.join(filtered_sentence)

# Recommend hotels
def recommend_hotels(prompt, top_n=9):
    processed_prompt = preprocess_prompt(prompt)
    prompt_vector = vectorizer.transform([processed_prompt])
    similarities = (tag_vectors * prompt_vector.T).toarray().flatten()
    top_indices = np.argsort(similarities)[-top_n:][::-1]
    return hotel_profiles_df.iloc[top_indices][['hotel_name','url', 'hotel_url', 'avg_rating', 'tags']]

# Sentiment analysis class
class SentimentAnalysis:
    def __init__(self):
        self.sia = SentimentIntensityAnalyzer()

    def analyze(self, prompt):
        tokens = word_tokenize(prompt)
        text = ' '.join(tokens)
        sentiment = self.sia.polarity_scores(text)
        if sentiment['compound'] >= 0.05:
            classification = 'Positive'
        elif sentiment['compound'] <= -0.05:
            classification = 'Negative'
        else:
            classification = 'Neutral'
        return {
            'Sentiment': sentiment,
            'Classification': classification
        }

# Initialize the sentiment analysis model
sentiment_model = SentimentAnalysis()

@app.route('/recommend', methods=['POST'])
def get_recommendations():
    data = request.get_json()
    user_prompt = data['prompt']
    recommended_hotels = recommend_hotels(user_prompt)
    return jsonify(recommended_hotels.to_dict(orient='records'))

@app.route('/sentiment_analysis', methods=['POST'])
def sentiment_analysis():
    data = request.get_json()
    prompt = data.get('prompt', '')
    result = sentiment_model.analyze(prompt)
    return jsonify(result)

if __name__ == '__main__':
    app.run(debug=True)
