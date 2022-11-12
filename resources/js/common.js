var templates = require('./templates');
var data = null;

templates.ajaxform(
    '.form',
    (response) => {
        templates.action_alert('success',response.success);
        setTimeout(() => {
            window.location = response.redirect;
        },2000);
    },
    (response) => {
        templates.action_alert('danger',response.error);
    },
    data
);

templates.ajaxform(
    '.form,.delete-product',
    (response) => {
        templates.action_alert('success',response.success);
        setTimeout(() => {
            window.location = response.redirect;
        },2000);
    },
    (response) => {
        templates.action_alert('danger',response.error);
    },
    data
);

