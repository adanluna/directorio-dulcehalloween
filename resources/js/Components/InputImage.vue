<script setup>
import InputError from '@/Components/InputError.vue'
</script>

<template>
    <div class="imagePreviewWrapper rounded-full" :style="{ 'background-image': `url(${(previewImage != '') ? previewImage : '/images/placeholder-photo.jpg'})` }" @click="selectImage">
    </div>
    <div :class="(errorValidation == '' && error_msg == '') ? 'border-gray-300' : 'border-red-500'" class="relative border-2 border-dashed rounded-lg p-6" id="dropzone">
        <input ref="fileInput" type="file" @input="pickFile" class="absolute inset-0 w-full h-full opacity-0 z-50" accept=".jpg, .jpeg, .gif, .png" />
        {{ error }}
        <div class="text-center">
            <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">

            <h3 class="mt-2 text-sm font-medium text-gray-900">
                <label for="file-upload" class="relative cursor-pointer">
                    <span>Arrastra</span>
                    <span class="text-blue-600"> o selecciona </span>
                    <span>una fotografía</span>
                    <input id="file-upload" name="file-upload" type="file" class="sr-only">
                </label>
            </h3>
            <p class="mt-1 text-xs text-gray-500">
                Archivos PNG, JPG y menor a {{ size }}MB
            </p>
        </div>

        <img src="" class="mt-4 mx-auto max-h-40 hidden" id="preview">
    </div>
    <InputError class="mt-3" :message="error_msg" />
</template>

<script>
export default {
    props: {
        size: {
            type: Number,
            default: 1
        },
        error: {
            type: String,
            default: ''
        },
        default: {
            type: String,
            default: ''
        }
    },
    data() {
        return {
            previewImage: this.default,
            error_msg: '',
            selected: false,
        };
    },
    computed: {
        errorValidation() {
            if (this.selected == false) {
                return this.error;
            }
            return '';
        }
    },
    methods: {
        selectImage() {
            this.$refs.fileInput.click()
        },
        pickFile() {
            this.error_msg = '';
            let input = this.$refs.fileInput
            let file = input.files
            if (file && file[0]) {

                if (file[0].size > (1024 * 1024) * this.size) {
                    this.error_msg = "La fotografía excede el tamaño de " + this.size + "MB"
                    this.selected = false;
                    this.previewImage = ''
                    this.$emit('file-updated', null)
                    return;
                }

                let reader = new FileReader
                reader.onload = e => {
                    this.previewImage = e.target.result
                }
                this.selected = true;
                reader.readAsDataURL(file[0])
                this.$emit('file-updated', file[0])
            }
        }
    }
}
</script>

<style scoped lang="scss">
.imagePreviewWrapper {
    width: 150px;
    height: 150px;
    display: block;
    cursor: pointer;
    margin: 0 auto 10px;
    background-size: cover;
    background-position: center center;
}
</style>
