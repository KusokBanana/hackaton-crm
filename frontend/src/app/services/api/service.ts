import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { appConfig } from 'src/app/app.config';

import { CreateTaskPayload } from './interfaces';
import { ClientsResponse } from './responses';




@Injectable()
export class ApiService {

    constructor(protected http: HttpClient) { }

    public getClients() {
        return this.http.get<ClientsResponse>(appConfig.api + '/clients')
    }

    public createTask(data: CreateTaskPayload) {
        return this.http.get(appConfig.api + '/tasks', { params: data as {} }); // todo post
    }
}
