export interface ClientsResponse {
    data: Client[];
}

export interface Client {
    id: number;
    age: number;
    gender: string;
    prediction?: Prediction;
}

export interface Prediction {
    mortgage_chance: number;
    consumer_credit_chance: number;
    get_credit_card_chance: number;
}