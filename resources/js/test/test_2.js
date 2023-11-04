import {
    UxmalInput
} from "../../../public/enmaca/laravel-uxmal/js/uxmal.js";

const uxmalInput = new UxmalInput();


document.addEventListener("DOMContentLoaded", function () {
    uxmalInput.init();
    const buttonEL = document.querySelector('#orderDeliveryDateId');
    console.log(buttonEL);
    if( buttonEL )
        buttonEL.onclick = () => {
            uxmalInput.get('selectDateId').flatpickrEl.open();
        };
});

