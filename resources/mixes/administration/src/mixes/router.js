import Slide from '../pages/Slide.vue';
import SlideGroup from '../pages/SlideGroup.vue';
import SlideGroupEdit from '../pages/SlideGroupEdit.vue';

export default function (injection) {
    injection.useExtensionRoute([
        {
            beforeEnter: injection.middleware.requireAuth,
            component: Slide,
            path: 'slide',
        },
        {
            beforeEnter: injection.middleware.requireAuth,
            component: SlideGroup,
            path: 'slide/group',
        },
        {
            beforeEnter: injection.middleware.requireAuth,
            component: SlideGroupEdit,
            path: 'slide/group/edit',
        },
    ]);
}