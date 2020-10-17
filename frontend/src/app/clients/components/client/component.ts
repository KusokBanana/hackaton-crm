import { Component, Input, OnDestroy, ViewChild } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { BsModalRef } from 'ngx-bootstrap/modal';
import { Subject } from 'rxjs';
import { catchError, take, takeUntil, tap } from 'rxjs/operators';
import { Client } from 'src/app/services/api/responses';
import { ApiService } from 'src/app/services/api/service';

@Component({
    selector: 'app-client',
    templateUrl: './component.html',
    styleUrls: ['./component.scss']
})
export class ClientComponent implements OnDestroy {
    private readonly destroy$ = new Subject();

    @Input() client: Client;
    @ViewChild('modal') modal: BsModalRef;

    public phone = false;
    public email = false;
    public chat = false;

    public loading = false;
    public error = false;

    public form = new FormGroup({
        name: new FormControl(null, Validators.required),
        description: new FormControl(),
        type: new FormControl(),
        date: new FormControl(),
    });

    constructor(private api: ApiService) { }

    public create(): void {
        this.form.controls.name.markAsDirty();
        this.form.updateValueAndValidity();
        if (this.form.invalid) {
            return;
        }

        const { phone, email, chat } = this;
        const client_id = this.client.id;

        const payload = {
            ...this.form.value, phone, email, chat, client_id,
        }

        this.api.createTask(payload).pipe(
            take(1),
            tap(() => this.success()),
            catchError(() => this.fail()),
            takeUntil(this.destroy$),
        ).subscribe();
    }

    private success(): void {
        this.loading = false;
        this.modal.hide();
    }

    private fail() {
        this.loading = false;
        this.error = true;
        return null
    }

    ngOnDestroy(): void {
        this.destroy$.next();
        this.destroy$.complete();
    }

}
