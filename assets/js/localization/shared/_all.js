// library import
import merge from 'deepmerge'
// get all shared lang files
import academic_background from './academic_background'
import messages from './messages'

// merge in single object; mapping to the correct property
const translations = {academic_background, messages};
let sharedTranslations = {};
Object.keys(translations).forEach(property => {
    const translation = translations[property];
    Object.keys(translation).forEach(lang => {
        if (!(lang in sharedTranslations)) {
            sharedTranslations[lang] = {};
        }
        sharedTranslations[lang][property] = translation[lang]
    });
});

// merge passed messages with the shared translations
export default function (messages) {
    return merge(messages, sharedTranslations);
}