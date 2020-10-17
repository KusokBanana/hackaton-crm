import { Component, Input, Output, ViewChild } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { BsModalRef } from 'ngx-bootstrap/modal';
import { Subject } from 'rxjs';
import { take, tap } from 'rxjs/operators';
import { Task } from 'src/app/services/api/responses';
import { ApiService } from 'src/app/services/api/service';

@Component({
    selector: 'app-task',
    templateUrl: './component.html',
    styleUrls: ['./component.scss']
})
export class TaskComponent {

    @Input() task: Task;
    @Input() active: boolean;

    @Output() change = new Subject();

    @ViewChild('modal') modal: BsModalRef;

    public form = new FormGroup({
        description: new FormControl(),
        status: new FormControl('success'),
    });

    constructor(private api: ApiService) {}

    complete() {
        this.api.completeTask(this.task.id, this.form.value.status, this.form.value.description).pipe(
            take(1),
            tap(() => this.change.next()),
            tap(() => this.modal.hide()),
        ).subscribe();
    }

    restore() {
        this.api.restoreTask(this.task.id).pipe(
            take(1),
            tap(() => this.change.next()),
            tap(() => this.modal.hide()),
        ).subscribe();
    }
}
