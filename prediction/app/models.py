  
from app import db


class Prediction(db.Model):
    __tablename__ = 'predictions'
    id = db.Column(db.Integer, primary_key=True)
    client_id = db.Column(db.Integer)
    mortage_chance = db.Column(db.Double)
    consumer_credit_chance = db.Column(db.Double)
    credit_card_chance = db.Column(db.Double)

    def __init__(self, client_id = None, mortage_chance=None, consumer_credit_chance=None, credit_card_chance=None):
        self.client_id = client_id
        self.mortage_chance = mortage_chance
        self.consumer_credit_chance = consumer_credit_chance
        self.credit_card_chance = credit_card_chance