<script setup>
import { useForm } from '@inertiajs/vue3'
import { NInput, NSelect, NInputGroup, NInputGroupLabel } from 'naive-ui'
import { toast } from 'vue3-toastify'
import { GoogleMap, AdvancedMarker } from 'vue3-google-map'

const center = { lat: 25.6872277, lng: -100.3168596 }
const markerOptions = { position: center, gmpDraggable: true }

</script>

<template>

    <Head title="Inscribe tu negocio" />
    <section class="border-t border-gray-200">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-10 lg:px-0 ">
            <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-2 flex flex-col items-center">
                <h2 class="mb-3 text-5xl tracking-tight font-extrabold text-purple-800 garamond">Inscribe tu negocio</h2>
                <p class="mb-6 text-xl">🎃 ¡Inscribe tu negocio <strong>GRATIS</strong> en el Directorio de Halloween! 👻 <br>Visibilidad. Clientes. Diversión. Todo en un solo lugar.</p>
                <p class="mb-6 text-base">¡Solo proporciona los datos de tu negocio y listo!<br /><span class="font-bold text-black"><span class="text-purple-500 font-bold text-sm">*</span> Datos obligatorios.</span></p>
            </div>
            <form @submit.prevent="submit">
                <fieldset :disabled="form.processing" style="display: contents;">
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-6">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Datos del Negocio</h2>
                            <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-12">
                                <div class="sm:col-span-6">
                                    <label for="first-name" class="block text-sm leading-6 text-gray-900">Nombre del Negocio <span class="text-purple-500 font-bold text-sm">*</span></label>
                                    <div class="mt-2">
                                        <n-input v-model:value="form.nombre" :status="form.errors.nombre ? 'error' : ''" type="text" maxlength="198" placeholder="" />
                                        <div class="error" v-if="form.errors.nombre">{{ form.errors.nombre }}</div>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="categoria" class="block text-sm leading-6 text-gray-900">Categoría <span class="text-purple-500 font-bold text-sm">*</span></label>
                                    <div class="mt-2">
                                        <n-select name="categoria" @update:value="getSub" v-model:value="form.categoria" :status="form.errors.categoria ? 'error' : ''" :options="categorias" placeholder="Seleccione" />
                                        <div class="error" v-if="form.errors.categoria">{{ form.errors.categoria }}</div>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="subcategoria" class="block text-sm leading-6 text-gray-900">Subcategoría <span class="text-purple-500 font-bold text-sm">*</span></label>
                                    <div class="mt-2">
                                        <n-select name="subcategoria" v-model:value="form.subcategoria" :status="form.errors.categoria ? 'error' : ''" :options="subcategorias.data" placeholder="Seleccione" />
                                        <div class="error" v-if="form.errors.subcategoria">{{ form.errors.subcategoria }}</div>
                                    </div>
                                </div>

                                <div class="sm:col-span-4">
                                    <label for="direccion" class="block text-sm leading-6 text-gray-900">Calle, Número, Colonia <span class="text-purple-500 font-bold text-sm">*</span></label>
                                    <div class="mt-2">
                                        <n-input v-model:value="form.direccion" :status="form.errors.direccion ? 'error' : ''" type="text" maxlength="198" placeholder="" />
                                        <div class="error" v-if="form.errors.direccion">{{ form.errors.direccion }}</div>
                                    </div>
                                </div>

                                <div class="sm:col-span-4">
                                    <label for="horario" class="block text-sm leading-6 text-gray-900">Horario entre semana <span class="text-purple-500 font-bold text-sm">*</span></label>
                                    <div class="mt-2">
                                        <n-input v-model:value="form.horario" :status="form.errors.horario ? 'error' : ''" type="text" maxlength="198" placeholder="Lunes a Viernes de 8:00am a 9:00pm" />
                                        <div class="error" v-if="form.errors.horario">{{ form.errors.horario }}</div>
                                    </div>
                                </div>

                                <div class="sm:col-span-4">
                                    <label for="horario_fin" class="block text-sm leading-6 text-gray-900">Horario fin semana <span class="text-purple-500 font-bold text-sm">*</span></label>
                                    <div class="mt-2">
                                        <n-input v-model:value="form.horario_fin" :status="form.errors.horario_fin ? 'error' : ''" type="text" maxlength="198" placeholder="Sábado 9:00am a 2:00 pm, Domingos Cerrado" />
                                        <div class="error" v-if="form.errors.horario_fin">{{ form.errors.horario_fin }}</div>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="email" class="block text-sm leading-6 text-gray-900">Correo electrónico <span class="text-purple-500 font-bold text-sm">*</span></label>
                                    <div class="mt-2">
                                        <n-input v-model:value="form.email" :status="form.errors.email ? 'error' : ''" type="text" maxlength="198" placeholder="" />
                                        <div class="error" v-if="form.errors.email">{{ form.errors.email }}</div>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="telefono" class="block text-sm leading-6 text-gray-900">Teléfono <span class="text-purple-500 font-bold text-sm">*</span></label>
                                    <div class="mt-2">
                                        <n-input v-model:value="form.telefono" :status="form.errors.telefono ? 'error' : ''" type="text" maxlength="198" placeholder="" />
                                        <div class="error" v-if="form.errors.telefono">{{ form.errors.telefono }}</div>
                                    </div>
                                </div>


                                <div class="sm:col-span-3">
                                    <label for="whatsapp" class="block text-sm leading-6 text-gray-900">Whatsapp</label>
                                    <div class="mt-2">
                                        <n-input v-model:value="form.whatsapp" :status="form.errors.whatsapp ? 'error' : ''" type="text" maxlength="198" placeholder="" />
                                        <div class="error" v-if="form.errors.whatsapp">{{ form.errors.whatsapp }}</div>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="website" class="block text-sm leading-6 text-gray-900">Website</label>
                                    <div class="mt-2">
                                        <n-input v-model:value="form.website" :status="form.errors.website ? 'error' : ''" type="text" maxlength="198" placeholder="" />
                                        <div class="error" v-if="form.errors.website">{{ form.errors.website }}</div>
                                    </div>
                                </div>

                                <!-- -->

                                <div class="sm:col-span-3">
                                    <label for="city" class="block text-sm leading-6 text-gray-900">Facebook</label>
                                    <div class="mt-2">
                                        <n-input-group>
                                            <n-input-group-label>facebook.com/</n-input-group-label>
                                            <n-input v-model:value="form.facebook" :status="form.errors.facebook ? 'error' : ''" placeholder="usuario" />
                                            <div class="error" v-if="form.errors.facebook">{{ form.errors.facebook }}</div>
                                        </n-input-group>
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="city" class="block text-sm leading-6 text-gray-900">Instagram</label>
                                    <div class="mt-2">
                                        <n-input-group>
                                            <n-input-group-label>instagram.com/</n-input-group-label>
                                            <n-input v-model:value="form.instagram" :status="form.errors.instagram ? 'error' : ''" placeholder="usuario" />
                                            <div class="error" v-if="form.errors.instagram">{{ form.errors.instagram }}</div>
                                        </n-input-group>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="city" class="block text-sm leading-6 text-gray-900">Twitter(X)</label>
                                    <div class="mt-2">
                                        <n-input-group>
                                            <n-input-group-label>x.com/</n-input-group-label>
                                            <n-input v-model:value="form.twitter" :status="form.errors.twitter ? 'error' : ''" placeholder="usuario" />
                                            <div class="error" v-if="form.errors.twitter">{{ form.errors.twitter }}</div>
                                        </n-input-group>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="city" class="block text-sm leading-6 text-gray-900">Tiktok</label>
                                    <div class="mt-2">
                                        <n-input-group>
                                            <n-input-group-label>tiktok.com/</n-input-group-label>
                                            <n-input v-model:value="form.tiktok" :status="form.errors.tiktok ? 'error' : ''" placeholder="usuario" />
                                            <div class="error" v-if="form.errors.tiktok">{{ form.errors.tiktok }}</div>
                                        </n-input-group>
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <label for="about" class="block text-sm leading-6 text-gray-900">Descripción del negocio <span class="text-purple-500 font-bold text-sm">*</span></label>
                                    <div class="mt-2">
                                        <n-input v-model:value="form.descripcion" :status="form.errors.descripcion ? 'error' : ''" type="textarea" rows="5" maxlength="800" show-count placeholder="" />
                                        <div class="error" v-if="form.errors.descripcion">{{ form.errors.descripcion }}</div>
                                    </div>
                                    <p class="mt-3 text-sm leading-6 text-gray-400 italic">Describe tu negocio, productos, servicios, etc.</p>
                                </div>
                            </div>
                        </div>


                        <div class="border-b border-gray-900/10 pb-6">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Datos de Contacto</h2>
                            <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-12">
                                <div class="sm:col-span-6">
                                    <label for="contacto_nombre" class="block text-sm leading-6 text-gray-900">Nombre del Contacto <span class="text-purple-500 font-bold text-sm">*</span></label>
                                    <div class="mt-2">
                                        <n-input v-model:value="form.contacto_nombre" :status="form.errors.contacto_nombre ? 'error' : ''" type="text" maxlength="198" placeholder="" />
                                        <div class="error" v-if="form.errors.contacto_nombre">{{ form.errors.contacto_nombre }}</div>
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="contacto_email" class="block text-sm leading-6 text-gray-900">Correo electrónico <span class="text-purple-500 font-bold text-sm">*</span></label>
                                    <div class="mt-2">
                                        <n-input v-model:value="form.contacto_email" :status="form.errors.contacto_email ? 'error' : ''" type="text" maxlength="198" placeholder="" />
                                        <div class="error" v-if="form.errors.contacto_email">{{ form.errors.contacto_email }}</div>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="contacto_telefono" class="block text-sm leading-6 text-gray-900">Teléfono <span class="text-purple-500 font-bold text-sm">*</span></label>
                                    <div class="mt-2">
                                        <n-input v-model:value="form.contacto_telefono" :status="form.errors.contacto_telefono ? 'error' : ''" type="text" maxlength="198" placeholder="" />
                                        <div class="error" v-if="form.errors.contacto_telefono">{{ form.errors.contacto_telefono }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-gray-900/10 pb-6">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Ubicación en mapa <span class="text-purple-500 font-bold text-sm">*</span></h2>
                            <p class="text-sm mb-3 text-gray-900">Arrastra y coloca el marcador en la dirección correcta de tu negocio en el mapa.</p>
                            <div class="error" v-if="form.errors.direccion_en_mapa">{{ form.errors.direccion_en_mapa }}</div>
                            <GoogleMap :api-key="google_api" mapId="mapahalloween" style="width: 100%; height: 500px" :center="center" :zoom="14">
                                <AdvancedMarker @dragend="updatePoints($event)" :options="markerOptions" />
                            </GoogleMap>
                        </div>



                        <div class="border-b border-gray-900/10 pb-6">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Fotografías</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Puedes subir hasta 2 fotografías en formato, JPG o PNG con un máximo de 2MB</p>

                            <div class="mt-3">
                                <label class="block text-sm leading-6 text-gray-900">Fotografía 1 <span class="text-purple-500 font-bold text-sm">*</span></label>
                                <input name="foto1" type="file" @input="form.foto1 = $event.target.files[0]" :status="form.errors.foto1 ? 'error' : ''" />
                                <div class="error" v-if="form.errors.foto1">{{ form.errors.foto1 }}</div>
                            </div>

                            <div class="mt-3">
                                <label class="block text-sm leading-6 text-gray-900">Fotografía 2</label>
                                <input type="file" @input="form.foto2 = $event.target.files[0]" />
                                <div class="error" v-if="form.errors.foto2">{{ form.errors.foto2 }}</div>
                            </div>
                        </div>

                    </div>
                </fieldset>


                <div class="mt-6 flex items-center justify-center">
                    <div v-if="form.progress" class="text-center">
                        <div class="text-xl">Enviando formulario...</div>
                        <div class="w-[200px] bg-purple-900 rounded-full dark:bg-gray-700">
                            <div class="bg-purple-600 text-lg font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" :style="'width:' + form.progress.percentage + '%'"> {{ form.progress.percentage }}%</div>
                        </div>
                    </div>
                    <button v-if="!form.processing" type="submit" class="text-xl rounded-md bg-purple-600 px-6 py-4 font-semibold text-white shadow-sm hover:bg-purple-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">{{ form.processing ? 'Enviando' : 'Enviar Formulario' }}</button>
                </div>
            </form>
        </div>

    </section>
</template>

<style scoped>
.error {
    color: red;
    font-size: 13px;
}
</style>

<script>
export default {
    props: {
        categorias: Object,
    },
    data() {
        return {
            form: useForm({
                nombre: '',
                categoria: '',
                subcategoria: '',
                direccion: '',
                telefono: '',
                email: '',
                website: '',
                whatsapp: '',
                horario: '',
                horario_fin: '',
                facebook: '',
                twitter: '',
                instagram: '',
                tiktok: '',
                descripcion: '',
                direccion_en_mapa: '',
                latitude: '',
                longitude: '',
                contacto_nombre: '',
                contacto_telefono: '',
                contacto_email: '',
                foto1: null,
                foto2: null,
                foto3: null,
                foto4: null,
                foto5: null,
            }),
            subcategorias: [],
            google_api: import.meta.env.VITE_GMAPS_API_KEY
        }
    },
    methods: {
        getSub(value) {
            this.axios
                .get(route('inscripcion.get.subcategorias', { categoria: value }), {})
                .then((response) => {
                    this.form.subcategoria = null,
                        this.subcategorias = response;
                })
                .catch((error) => {
                    toast.error("Ocurrió un error")
                });
        },
        submit() {
            this.form.post(route('inscripcion.new'), {
                forceFormData: true,
                preserveScroll: false,
                onSuccess: () => { },
                onError: (error) => {
                    toast.error("Hubo un error de validación, por favor revisa la información que proporcionaste");
                }
            })
        },
        updatePoints(event) {
            var location = event.latLng.toJSON()
            this.form.direccion_en_mapa = location.toString()
            this.form.latitude = location.lat
            this.form.longitude = location.lng
        }
    },
}
</script>
