require("./bootstrap");
require("@fortawesome/fontawesome-free/js/all.min.js");

import Alpine from "alpinejs";
import intersect from "@alpinejs/intersect";
import timeSince from "./time-since";

Alpine.plugin(intersect);
window.Alpine = Alpine;
window.timeSince = timeSince;

Alpine.start();
