import os

from flask import Flask, render_template, request
from flask_migrate import Migrate
from flask_sqlalchemy import SQLAlchemy, text


database_uri = 'postgresql+psycopg2://{dbuser}:{dbpass}@{dbhost}/{dbname}'.format(
    dbuser=os.environ['POSTGRES_USER'],
    dbpass=os.environ['POSTGRES_PASSWORD'],
    dbhost="database",
    dbname=os.environ['POSTGRES_DB']
)

app = Flask(__name__)
app.config.update(
    SQLALCHEMY_DATABASE_URI=database_uri,
    SQLALCHEMY_TRACK_MODIFICATIONS=False,
)

# initialize the database connection
db = SQLAlchemy(app)

# initialize database migration management
migrate = Migrate(app, db)


@app.route('/predict')
def predict():
    from models import Prediction
    guests = Prediction.query.all()

    statement = text("""SELECT * FROM clients
        JOIN transactions_totals ON clients.id = transactions_totals.client_id""")
    rows = db.engine.execute(statement)
    print(rows)
