import http from 'k6/http';
import { sleep } from 'k6';

export const options = {
  vus: 100,
  duration: '30s',
  insecureSkipTLSVerify: true,
};

export default function () {
  const host = __ENV.TESTHOST || 'http://localhost:8000'; // Usa a variável de ambiente HOST ou um valor padrão
  http.get(`${host}/cpu/`);
  sleep(1);
}
