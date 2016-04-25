import {Injectable} from "angular2/core";
import {Http, Headers} from "angular2/http";
import 'rxjs/add/operator/map';

@Injectable()
export class httpService{
    private _headers = new Headers();

    constructor(private _http: Http){
        this._headers.append('Content-Type', 'application/x-www-form-urlencoded'); //HTML Form header
    }

    get(url: string, params = {}) {
        return this._http.get(url + this.formatParams(params, "?"))
            .map(res => res.json());
    }

    post(url: string, params = {}){
        return this._http.post(url, this.formatParams(params), {
            headers: this._headers
        }).map(res => res.json());
    }

    put(url: string, params = {}){

        return this._http.put(url, this.formatParams(params), {
            headers: this._headers
        }).map(res => res.json());
    }

    patch(url: string, params = {}){
        return this._http.patch(url, this.formatParams(params), {
            headers: this._headers
        }).map(res => res.json());
    }

    delete(url: string, params = {}) {
        return this._http.delete(url + this.formatParams(params, "?"))
            .map(res => res.json());
    }

    private formatParams(params, prefix = ""){
        if(Object.keys(params).length === 0) {
            return "";
        } 

        return prefix + Object.keys(params)
            .map(function(key) {
                return key+"="+params[key]
            }).join("&");
    }
}