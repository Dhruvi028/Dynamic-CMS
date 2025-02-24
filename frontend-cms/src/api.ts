import axios from 'axios';

const VITE_API_URL = import.meta.env.VITE_API_URL;

const api = axios.create({
  baseURL: VITE_API_URL,
});

export const fetchPage = (path: string) => api.get(`/pages/${path}`);
export const fetchPages = () => api.get('/pages')
export const createPage = (data: object) => api.post('/pages', data);
export const updatePage = (id: number, data: object) => api.put(`/pages/${id}`, data);
export const deletePage = (id: number) => api.delete(`/pages/${id}`);
