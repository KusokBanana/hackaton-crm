export interface ClientsResponse {
    data: Client[];
}

export interface TasksResponse {
    data: Task[];
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

export interface Task {
    id: number;
    created_at: string;
    name: string;
    description?: string;
    date?: string;
    type?: string;
    phone: boolean;
    email: boolean;
    chat: boolean;
}