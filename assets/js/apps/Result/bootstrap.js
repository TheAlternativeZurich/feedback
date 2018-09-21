import Vue from 'vue'
import VueI18n from 'vue-i18n'
// components
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
// app
import Result from './result'
// messages
import Messages from '../../localization/result'
import mergeMessages from '../../localization/shared/_all'

Vue.config.productionTip = false;


if (document.getElementById("result") !== null) {
    // register plugins
    Vue.use(VueI18n);

    // register components
    Vue.component('font-awesome-icon', FontAwesomeIcon);

    // initialize messages
    const i18n = new VueI18n({
        locale: document.documentElement.lang.substr(0, 2),
        messages: mergeMessages(Messages),
    });

    // boot app
    new Vue({
        i18n,
        el: '#result',
        template: '<Result/>',
        components: {Result}
    });
}