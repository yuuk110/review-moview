require('./bootstrap');

Vue.component('v-star', {
        props: ['value'],
        template: '<span><span v-for="number in parseInt(value)">&#x2B50;</span></span>'
    });