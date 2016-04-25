import {Component} from 'angular2/core';

@Component({
    selector: 'my-gallery',
    templateUrl: './js/gallery/app/components/gallery/gallery.html',
    providers: []
})

export class GalleryComponent {
    date: string = "What the fuck is wrong with this?";
    constructor(){
    }
}
