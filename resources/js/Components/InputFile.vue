<script setup>
import InputError from '@/Components/InputError.vue'
</script>

<template>
    <label class="block">
        <span class="sr-only">Seleccionar archivo</span>
        <input @change="pickFile" ref="fileInput" :class="(error_msg=='')?'border-gray-300':'border-red-500'" class="block w-full text-md text-gray-900 border rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" type="file">
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">Archivos PDF y WORD máximo {{ size }}MB.</p>
    </label>
    <InputError class="mt-3" :message="error_msg" />
</template>

<script>
export default {
    props: {
        size: {
            type: Number,
            default: 1
        }
    },
    data() {
        return {
            error_msg: '',
        };
    },
    methods: {
        pickFile() {
            this.error_msg= '';
            let input = this.$refs.fileInput
            let file = input.files
            if (file && file[0]) {

                if (file[0].size > (1024 * 1024) * this.size) {
                    this.error_msg = "El archivo excede el tamaño de " + this.size + "MB"
                    input.value = ''
                    this.$emit('file-updated', null)
                    return;
                }
                this.$emit('file-updated', file[0])
            }
        }
    }
}
</script>
