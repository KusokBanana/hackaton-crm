import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { ModalModule } from 'ngx-bootstrap/modal';

import { ApiService } from '../services/api/service';
import { ClientsRoutingModule } from './app-routing.module';
import { components } from './components';


@NgModule({
  declarations: [components],
  imports: [
    CommonModule,
    ReactiveFormsModule,
    FormsModule,
    ClientsRoutingModule,
    ModalModule.forRoot(),
  ],
  providers: [ApiService]
})
export class ClientsModule { }
