import Vue from 'vue'
import VueI18n from 'vue-i18n'
// components
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
// app
import Vote from './vote'
// messages
import Messages from '../../localization/vote'
import mergeMessages from '../../localization/shared/_all'

Vue.config.productionTip = false;


if (document.getElementById("vote") !== null) {
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
        el: '#vote',
        template: '<Vote/>',
        components: {Vote}
    });
}