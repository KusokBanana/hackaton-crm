import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { appRoutePaths } from './app.config';


const routes: Routes = [
  {
    path: appRoutePaths.root,
    pathMatch: 'full',
    loadChildren: () => import('./tasks/tasks.module').then((m) => m.TasksModule),
  },
  {
    path: appRoutePaths.clients,
    loadChildren: () => import('./clients/clients.module').then((m) => m.ClientsModule),
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
