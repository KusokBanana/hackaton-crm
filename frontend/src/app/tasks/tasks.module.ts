import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { ModalModule } from 'ngx-bootstrap/modal';
import { ProgressbarModule } from 'ngx-bootstrap/progressbar';

import { ApiService } from '../services/api/service';
import { TasksRoutingModule } from './app-routing.module';
import { components } from './components';


@NgModule({
  declarations: [components],
  imports: [
    CommonModule,
    TasksRoutingModule,
    ReactiveFormsModule,
    FormsModule,
    ProgressbarModule.forRoot(),
    ModalModule.forRoot(),
  ],
  providers: [ApiService]
})
export class TasksModule { }
