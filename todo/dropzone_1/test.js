import {
    Uxmal
} from "laravel-uxmal-npm";

import 'laravel-uxmal-npm/dist/esm/uxmal.css';

const uxmal = new Uxmal();
document.addEventListener("DOMContentLoaded", function () {
    uxmal.init(document);
});

