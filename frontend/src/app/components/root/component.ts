import { Component, OnInit } from '@angular/core';

@Component({
    selector: 'app-root',
    templateUrl: './component.html',
    styleUrls: ['./component.scss']
})
export class RootComponent implements OnInit {
    public loaded: boolean = false;

    ngOnInit() {
        this.loaded = true;
    }
}
