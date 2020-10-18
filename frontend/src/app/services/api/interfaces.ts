export interface CreateTaskPayload {
    name: string;
    description?: string;
    type?: string;
    date?: string;
    phone: boolean;
    email: boolean;
    chat: boolean;
    client_id: number;
}