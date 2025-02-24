import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ErrorPage from '@/components/ErrorPage.vue'
import ProfileView from '@/views/ProfileView.vue'
import ProfileMed from '@/components/ProfileMed.vue'
import HelpUs from '@/components/HelpUs.vue'
import OnlineConsultation from '@/views/OnlineConsultation.vue'
import DoctorPersonal from '@/views/DoctorPersonal.vue'
import ChatWithDoctor from '@/views/ChatWithDoctor.vue'
import DoctorPersonalEdit from '@/views/DoctorPersonalEdit.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },

    {
      path: '/online/:id',
      name: 'online',
      component: OnlineConsultation,
    },
    {
      path: '/online/:id/:idPersonal',
      name: 'doctorPersonal',
      component: DoctorPersonal,
    },
    {
      path: '/onlinePersonal/:idPersonal',
      name: 'DoctorPersonalEdit',
      component: DoctorPersonalEdit,
    },
    {
      path: '/chat/:idChat',
      name: 'chat',
      component: ChatWithDoctor,
    },
    {
      path: '/profile',
      name: 'profile',
      component: ProfileView,
      children: [
        {
          path: 'settings',
          name: 'settings',
          component: ProfileMed,
        },
        {
          path: 'help',
          name: 'help',
          component: HelpUs,
        },
      ],
    },
    {
      path: '/:catchAll(.*)',
      name: 'error',
      component: ErrorPage,
    },
  ],
})

export default router
