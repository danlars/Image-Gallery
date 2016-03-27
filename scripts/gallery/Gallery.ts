import {Component} from 'angular2/core';
import {RouteConfig, RouterOutlet, RouterLink} from "angular2/router";
import {ProfileComponent} from "./app/components/profile/profile";
import {GalleryComponent} from "./app/components/gallery/gallery";

@Component({
    selector: 'my-gallery',
    templateUrl: './js/gallery/layout.html',
    directives: [RouterOutlet, RouterLink],
    providers: []
})

@RouteConfig([
    {path: '/', component: ProfileComponent, name: 'Profile', useAsDefault: true},
    {path:'/gallery', name: 'Gallery', component: GalleryComponent},
])

export class AppComponent {

}
