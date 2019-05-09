import axios from 'axios';

/* global BASE_URL */

const http = axios.create({
  baseURL: BASE_URL,
});

http.interceptors.response.use(response => {
  let {status, data} = response;
  if (status >= 300) {
    return Promise.reject('Failed to fetch data.');
  }
  const {code} = data;
  if (code !== 0) {
    return Promise.reject(data);
  }
  data = data.data;
  return data;
}, error => Promise.reject(error));

export default http;
