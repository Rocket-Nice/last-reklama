import '../scss/app.scss';
import './bootstrap';
import accordion from "./components/accordion";
import basket from "./components/basket";
import filter from "./components/filter";
import mainCode from "./components/mainCode";
import map from "./components/map";
import modals from "./components/modals";
import sliders from "./components/sliders";

function main() {
    accordion();
    basket();
    filter();
    mainCode();
    map();
    modals();
    sliders();
}

document.addEventListener("DOMContentLoaded", main);
