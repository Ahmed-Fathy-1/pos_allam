<template>
    <div>
        <h1>PDF Files</h1>
        <ul>
            <li v-for="(pdf, index) in pdfs" :key="index">
                <a :href="pdf.url" target="_blank" rel="noopener noreferrer">
                    <img :src="pdf.image" :alt="pdf.image">
                    <p>{{ pdf.name }}</p>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
import { mounted } from 'vue';

export default {
    data() {
        return {
            pdfs: [],
        };
    },
    methods: {
        async fetchPdfs() {
            try {
                const response = await fetch('http://localhost:4001/pdfs');
                const data = await response.json();
                
                this.pdfs = data;

                console.log(this.pdfs);

                
            } catch (error) {
                console.error("Error fetching PDF data:", error);
            }
        },
    },

    mounted() {
        this.fetchPdfs();
    }
};
</script>

<style scoped>
h1 {
    color: #333;
    padding-top: 100px;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    margin: 10px 0;
}

a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
}

a{
    
}
</style>


