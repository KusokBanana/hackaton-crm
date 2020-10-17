import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';

import { TasksRoutingModule } from './app-routing.module';
import { components } from './components';



@NgModule({
  declarations: [components],
  imports: [
    CommonModule,
    TasksRoutingModule,
  ]
})
export class TasksModule { }
