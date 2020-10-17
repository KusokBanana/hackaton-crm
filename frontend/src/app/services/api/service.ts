import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { appConfig } from 'src/app/app.config';

import { CreateTaskPayload } from './interfaces';
import { ClientsResponse, TasksResponse } from './responses';




@Injectable()
export class ApiService {

    constructor(protected http: HttpClient) { }

    public getClients() {
        return this.http.get<ClientsResponse>(appConfig.api + '/clients')
    }

    public getActiveTasks() {
        return this.http.get<TasksResponse>(appConfig.api + '/tasks/active');
    }

    public getCompletedTasks() {
        return this.http.get<TasksResponse>(appConfig.api + '/tasks/inactive');
    }

    public createTask(data: CreateTaskPayload) {
        const params = this.formatParams(data);
        return this.http.get(appConfig.api + '/tasks/create', { params }); // todo post
    }

    public completeTask(id: number, status: string, description?: string) {
        const params = this.formatParams({ id, status, description });
        return this.http.get(appConfig.api + `/tasks/complete`, { params }); // todo post
    }

    public restoreTask(id: number) {
        const params = this.formatParams({ id });
        return this.http.get(appConfig.api + `/tasks/restore`, { params }); // todo post
    }

    private formatParams(data: {}) {
        return Object.keys(data).reduce((acc, key) => {
            if (data[key] != null) {
                acc[key] = data[key];
            }
            return acc;
        }, {});
    }
}
