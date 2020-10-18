  
from app import db


class Prediction(db.Model):
    __tablename__ = 'predictions'
    id = db.Column(db.Integer, primary_key=True)
    client_id = db.Column(db.Integer)
    mortage_chance = db.Column(db.Double)
    consumer_credit_chance = db.Column(db.Double)
    credit_card_chance = db.Column(db.Double)

    def __init__(self, name=None, email=None):
        self.name = name
        self.email = email