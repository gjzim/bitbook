require("./bootstrap");
require("@fortawesome/fontawesome-free/js/all.min.js");

import Alpine from "alpinejs";
import intersect from "@alpinejs/intersect";
import timeSince from "./time-since";
import singlePostActions from "./single-post-actions";

Alpine.plugin(intersect);
window.Alpine = Alpine;
window.timeSince = timeSince;
window.singlePostActions = singlePostActions;

Alpine.start();
