import {Component} from 'angular2/core';
import {httpService} from "../../services/httpService";
import {Http} from "angular2/http";
import {Alert} from "ng2-bootstrap/components/Alert";

@Component({
    selector: 'my-profile',
    templateUrl: './js/gallery/app/components/profile/profile.html',
    providers: [httpService],
    directives: [Alert]
})

export class ProfileComponent {

    public getResultData: string;
    public postResultData: string;

    constructor(private _httpService: httpService, private http: Http){}

    getData() {
        this._httpService.get("http://date.jsontest.com")
            .subscribe(
            data => this.getResultData = JSON.stringify(data),
            error => alert(error),
            () => console.log('Finished get')
        );
    };

    postData() {
        var params = {
            "json": "{ \"test\": \"Hej\" }",
            "one": "two",
            "key": "value",
            "test": "Hej"
        };
        this._httpService.post("http://validate.jsontest.com", params)
            .subscribe(
            data => this.postResultData = JSON.stringify(data),
            error => alert(error),
            () => console.log('Finished post')
        );
    }
}
