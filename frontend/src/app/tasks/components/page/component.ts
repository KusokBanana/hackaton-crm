import { Component, OnInit } from '@angular/core';
import { ReplaySubject } from 'rxjs';
import { map, switchMap } from 'rxjs/operators';
import { ApiService } from 'src/app/services/api/service';

@Component({
    selector: 'app-page',
    templateUrl: './component.html',
    styleUrls: ['./component.scss']
})
export class PageComponent implements OnInit {

    private load$ = new ReplaySubject();

    public activeTasks$ = this.load$.pipe(
        switchMap(() => this.api.getActiveTasks().pipe(
            map(result => result.data),
        ))
    );
    public completedTasks$ = this.load$.pipe(
        switchMap(() => this.api.getCompletedTasks().pipe(
            map(result => result.data),
        ))
    );

    constructor(private api: ApiService) {}

    ngOnInit() {
        this.load$.next();
    }

    reload() {
        this.load$.next();
    }
}
