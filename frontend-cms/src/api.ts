import axios from 'axios';

const api = axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
});

export const fetchPage = (path: string) => api.get(`/pages/${path}`);
export const fetchPages = () => api.get('/pages')
export const createPage = (data: object) => api.post('/pages', data);
export const updatePage = (id: number, data: object) => api.put(`/pages/${id}`, data);
export const deletePage = (id: number) => api.delete(`/pages/${id}`);
