from flask import Flask, request, jsonify
from flask_cors import CORS
import nltk
from nltk.sentiment.vader import SentimentIntensityAnalyzer

app = Flask(__name__)
CORS(app)  # Enable CORS

class SentimentAnalysis:
    def __init__(self):
        self.sia = SentimentIntensityAnalyzer()

    def analyze(self, prompt):
        tokens = nltk.word_tokenize(prompt)
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

model = SentimentAnalysis()

@app.route('/sentiment_analysis', methods=['POST'])
def sentiment_analysis():
    data = request.get_json()
    prompt = data.get('prompt', '')
    result = model.analyze(prompt)
    return jsonify(result)

if __name__ == '__main__':
    nltk.download('vader_lexicon')
    nltk.download('punkt')
    app.run(debug=True)
