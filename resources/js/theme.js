window._ = require('lodash');
import Swal from 'sweetalert2/dist/sweetalert2.js';

try {
    window.bootstrap = require("bootstrap5/dist/js/bootstrap.bundle.min")
    window.Swal = Swal;
    require('bootstrap');
} catch (e) {}
