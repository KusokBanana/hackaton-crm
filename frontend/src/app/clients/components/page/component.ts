import { Component } from '@angular/core';
import { map } from 'rxjs/operators';
import { Client } from 'src/app/services/api/responses';
import { ApiService } from 'src/app/services/api/service';

@Component({
    selector: 'app-page',
    templateUrl: './component.html',
    styleUrls: ['./component.scss']
})
export class PageComponent {

    constructor(private api: ApiService) {}

    public clients$ = this.api.getClients().pipe(
        map(result => result.data),
    );

    trackByFn(_: number, client: Client) {
        return client.id;
    }

}
