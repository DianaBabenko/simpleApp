import Resumable from 'resumablejs';
import Vue from "vue";

import './bootstrap';

// const token = document.querySelector('input[name="_token"]').value;
//
// const r = new Resumable({
//     target: '/upload-advanced',
//     chunkSize: 2 * 1024 * 1024,
//     testChunks:false,
//     simultaneousUploads: 1,
//     headers:{
//         'X-CSRF-Token': token
//     },
//     query:{
//         _token : token
//     }
// });
//
// r.assignBrowse(document.getElementById('browseButton'));
//
// document.getElementById('uploadTestBtn').addEventListener('click', () => {
//     r.upload();
// });
//
// r.on('fileProgress', file => {
//     const progress = Math.floor(file.progress() * 100);
//
//     document.getElementById('status').innerText = `${progress}/100`;
// });
// console.log(r.progress());

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

axios.get('/oauth/clients')
    .then(response => {
        console.log(response.data);
    });

const data = {
    name: 'Client Name',
    redirect: 'http://app.test/blog/posts'
};

axios.post('/oauth/clients', data)
    .then(response => {
        console.log(response.data);
    })
    .catch (response => {
        // List errors on response...
    });

new Vue({
    el: '#app',
});
