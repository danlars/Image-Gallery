///<reference path="../../node_modules/angular2/typings/browser.d.ts"/>
///<reference path="../../typings/browser.d.ts"/>

import {bootstrap} from 'angular2/platform/browser'
import {AppComponent} from './gallery/Gallery'
import {ROUTER_PROVIDERS, HashLocationStrategy, LocationStrategy} from "angular2/router";
import {provide} from "angular2/core";
import {HTTP_PROVIDERS} from "angular2/http";
import {httpService} from "./gallery/app/services/httpService";

bootstrap(AppComponent,
    [
        ROUTER_PROVIDERS,
        provide(LocationStrategy, {useClass: HashLocationStrategy}),
        HTTP_PROVIDERS,
        httpService
    ]
);