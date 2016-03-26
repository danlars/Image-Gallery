import {Component} from 'angular2/core';
import {RouteConfig, ROUTER_DIRECTIVES, Router} from "angular2/router";
import {IndexComponent} from "./app/index/index";
import {TestComponent} from "./app/test/test";

@Component({
    selector: 'my-gallery',
    templateUrl: './js/gallery/layout.html',
    directives: [ROUTER_DIRECTIVES]
})

@RouteConfig([
    {path:'/index', name: 'Index', component: IndexComponent},
    {path:'/test', name: 'Test', component: TestComponent},
])

export class AppComponent {
    constructor(private router: Router){
        router.navigate(['Index']);
    }
}
