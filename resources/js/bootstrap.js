import _ from 'lodash'; // Thay 'require' bằng 'import'
import axios from 'axios';

window._ = _; // Gán _ vào biến toàn cục để sử dụng trong các tệp khác
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

