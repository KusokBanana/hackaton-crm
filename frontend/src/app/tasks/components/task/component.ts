import { Component, Input, OnChanges, Output, ViewChild } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { BsModalRef } from 'ngx-bootstrap/modal';
import { Subject } from 'rxjs';
import { take, tap } from 'rxjs/operators';
import { Task, TaskTypes } from 'src/app/services/api/responses';
import { ApiService } from 'src/app/services/api/service';

@Component({
    selector: 'app-task',
    templateUrl: './component.html',
    styleUrls: ['./component.scss']
})
export class TaskComponent implements OnChanges {
    private readonly typeTexts = {
        [TaskTypes.mortgage]: 'Ипотека',
        [TaskTypes.consumer_credit]: 'Кредит',
        [TaskTypes.credit_card]: 'Кредитная карта',
    };


    @Input() task: Task;
    @Input() active: boolean;

    @Output() change = new Subject();

    @ViewChild('modal') modal: BsModalRef;

    public form = new FormGroup({
        description: new FormControl(),
        status: new FormControl('success'),
    });

    public typeText: string;
    public chances: number;

    constructor(private api: ApiService) {}

    ngOnChanges() {
        switch(this.task.type) {
            case TaskTypes.mortgage:
                this.typeText = 'Ипотека';
                this.chances = this.task.client.prediction.mortgage_chance;
                break;
            case TaskTypes.consumer_credit:
                this.typeText = 'Кредит';
                this.chances = this.task.client.prediction.consumer_credit_chance;
                break;
            case TaskTypes.credit_card:
                this.typeText = 'Кредитная карта';
                this.chances = this.task.client.prediction.credit_card_chance;
                break;
        }
    }

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
