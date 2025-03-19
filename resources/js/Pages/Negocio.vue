<script setup>
import { Link } from '@inertiajs/vue3'
import { GoogleMap, AdvancedMarker } from 'vue3-google-map'
import NegocioBox from '@/Components/NegocioBox.vue';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faMagnifyingGlass } from '@fortawesome/free-solid-svg-icons'
import { faWhatsapp, faFacebook, faTwitter, faTiktok, faInstagram } from '@fortawesome/free-brands-svg-icons'
library.add({ faWhatsapp, faFacebook, faTwitter, faTiktok, faInstagram })

</script>

<template>

    <Head :title="negocio.nombre" />
    <section class="border-t border-gray-200">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:pt-10 lg:pb-8 lg:px-0 ">
            <div class="mx-auto text-center">
                <h2 class="text-sm text-gray-800">
                    <Link class="underline" :href="route('negocios', { categoria: negocio.categoria.slug })">{{ negocio.categoria.nombre }}</Link> /
                    <Link class="underline" :href="route('negocios', { categoria: negocio.categoria.slug, subcategoria: negocio.subcategoria.slug })">{{ negocio.subcategoria.nombre }}</Link>
                </h2>
                <h2 class="mb-3 mt-2 text-2xl md:text-4xl tracking-tight font-extrabold text-purple-800">{{ negocio.nombre }}</h2>
            </div>
        </div>
        <div class="grid grid-col-1 md:grid-flow-col md:auto-cols-auto">
            <div v-for="(item, index) in photos" :key="index" class="bg-cover bg-center h-[300px] sm:h-128" :style="{ backgroundImage: `url(/storage/${item})` }">
            </div>
        </div>
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-10 lg:px-0 ">
            {{ negocio.descripcion }}

            <div class="grid md:grid-cols-2 grid-cols-1 gap-4 my-10">
                <div>
                    <div class="px-0">
                        <h3 class="text-xl font-semibold leading-7 text-gray-900">Información General</h3>
                    </div>
                    <div class="mt-6 border-t border-gray-100">
                        <dl class="divide-y divide-gray-100">
                            <div class="py-6 sm:grid sm:grid-cols-3 sm:gap-4 px-0">
                                <dt class="font-medium leading-6 text-gray-900">Horario</dt>
                                <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ negocio.horario }}<br>{{ negocio.horario_fin }}</dd>
                            </div>
                            <div class="py-6 sm:grid sm:grid-cols-3 sm:gap-4 px-0">
                                <dt class="font-medium leading-6 text-gray-900">Dirección</dt>
                                <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ negocio.direccion }}</dd>
                            </div>
                            <div v-if="negocio.telefono !== null" class="py-6 sm:grid sm:grid-cols-3 sm:gap-4 px-0">
                                <dt class="font-medium leading-6 text-gray-900">Teléfono</dt>
                                <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ negocio.telefono }}</dd>
                            </div>
                            <div v-if="negocio.negocio !== null" class="py-6 sm:grid sm:grid-cols-3 sm:gap-4 px-0">
                                <dt class="font-medium leading-6 text-gray-900">Correo</dt>
                                <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ negocio.email }}</dd>
                            </div>
                            <div v-if="negocio.website !== null" class="py-6 sm:grid sm:grid-cols-3 sm:gap-4 px-0">
                                <dt class="font-medium leading-6 text-gray-900">Website</dt>
                                <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ negocio.website }}</dd>
                            </div>
                            <div v-if="negocio.whatsapp !== null" class="py-6 sm:grid sm:grid-cols-3 sm:gap-4 px-0">
                                <dt class="font-medium leading-6 text-gray-900">Contacto</dt>
                                <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <a :href="'https://wa.me/+52' + negocio.whatsapp" target="_blank" class="bg-green-300 hover:bg-green-400 text-gray-800 py-2 px-4 rounded-full inline-flex items-center">
                                        <font-awesome-icon :icon="['fab', 'whatsapp']" size="lg" />
                                        <span class="ml-2">Mensaje Whatsapp</span>
                                    </a>
                                </dd>
                            </div>
                            <div class="py-6 sm:grid sm:grid-cols-3 sm:gap-4 px-0">
                                <dt class="font-medium leading-6 text-gray-900">Redes Sociales</dt>
                                <dd class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <div class="flex">
                                        <a v-if="negocio.facebook !== null" :href="negocio.facebook" class="ml-4"><font-awesome-icon size="2x" :icon="['fab', 'facebook']" /></a>
                                        <a v-if="negocio.twitter !== null" :href="negocio.twitter" class="ml-4"><font-awesome-icon size="2x" :icon="['fab', 'twitter']" /></a>
                                        <a v-if="negocio.instagram !== null" :href="negocio.instagram" class="ml-4"><font-awesome-icon size="2x" :icon="['fab', 'instagram']" /></a>
                                        <a v-if="negocio.tiktok !== null" :href="negocio.tiktok" class="ml-4"><font-awesome-icon size="2x" :icon="['fab', 'tiktok']" /></a>
                                    </div>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
                <!-- ... -->
                <div v-if="negocio.latitude !== null">
                    <div class="px-0">
                        <h3 class="text-xl font-semibold leading-7 text-gray-900">Ubicación</h3>
                    </div>
                    <div class="mt-6 border-t border-gray-100">
                        <dl class="divide-y divide-gray-100">
                            <div class="sm:py-6 px-0">
                                <GoogleMap api-key="AIzaSyCCXvzPtv4i8A30vcaFm5BAejmwW3ZxUaE" mapId="mapa_negocio" style="width: 100%; height: 500px" :center="{ lat: parseFloat(negocio.latitude), lng: parseFloat(negocio.longitude) }" :zoom="18">
                                    <AdvancedMarker :options="{ position: { lat: parseFloat(negocio.latitude), lng: parseFloat(negocio.longitude) } }" />
                                </GoogleMap>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="border-t border-gray-200" v-if="negocios.length > 0">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-10 lg:px-0 ">
            <div class="mx-auto text-center mb-8 lg:mb-16">
                <h2 class="mb-3 text-3xl tracking-tight font-extrabold text-purple-800">Otros negocios de {{ negocio.categoria.nombre }} que te pueden interesar</h2>
            </div>
            <div class="grid md:px-5 gap-8 mb-6 grid-cols-1 md:grid-cols-3 auto-cols-max">
                <NegocioBox v-for="(item, index) in negocios" :key="index" :item="item" />
            </div>
        </div>
    </section>
</template>

<style scoped></style>
<script>
export default {
    props: {
        negocio: Object,
        negocios: Object,
    },
    computed: {
        photos: function () {
            let photos = []
            photos[0] = this.negocio.foto1;
            if (this.negocio.foto2 !== null && this.negocio.foto2 != '') {
                photos[1] = this.negocio.foto2;
            };
            if (this.negocio.foto3 != null && this.negocio.foto3 != '') {
                photos[2] = this.negocio.foto3;
            };
            if (this.negocio.foto4 != null && this.negocio.foto2 != '') {
                photos[3] = this.negocio.foto4;
            };
            if (this.negocio.foto5 !== null && this.negocio.foto5 != '') {
                photos[4] = this.negocio.foto5;
            };
            return photos;
        }
    },
    data() {
        return {
        }
    },
    methods: {
    },
}
</script>
