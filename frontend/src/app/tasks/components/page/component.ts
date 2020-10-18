import { Component, OnInit } from '@angular/core';
import { ReplaySubject } from 'rxjs';
import { map, switchMap, tap } from 'rxjs/operators';
import { Task } from 'src/app/services/api/responses';
import { ApiService } from 'src/app/services/api/service';

@Component({
    selector: 'app-page',
    templateUrl: './component.html',
    styleUrls: ['./component.scss'],
})
export class PageComponent implements OnInit {

    private load$ = new ReplaySubject();

    public activeCount = 0;
    public completedCount = 0;

    public activeTasks$ = this.load$.pipe(
        switchMap(() => this.api.getActiveTasks().pipe(
            tap(result => this.activeCount = result.total),
            map(result => result.data),
        ))
    );
    public completedTasks$ = this.load$.pipe(
        switchMap(() => this.api.getCompletedTasks().pipe(
            tap(result => this.completedCount = result.total),
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

    trackByFn(_: number, task: Task) {
        return task.id;
    }
}
