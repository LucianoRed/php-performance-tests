import http from 'k6/http';
import { sleep } from 'k6';

export const options = {
  vus: 100, // número de usuários virtuais
  duration: '30s', // duração do teste
  tls: {
    insecureSkipTLSVerify: true, // Ignorar erros de certificado TLS
  },
};

export default function () {
  http.get('http://localhost:8000/cpu/');
  sleep(1);
}
