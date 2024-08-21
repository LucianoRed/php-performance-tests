### Resultados
![image](https://github.com/user-attachments/assets/51c42d90-8fd9-4985-af77-159550dc0edb)

## Cenário testado
- Cluster OpenShift 4.15.10 na AWS em us-east-2
- Maquina RHEL em VPC dedicada na AWS em us-east-2 do tipo t3.medium para disparo dos testes
- A VPC do OpenShift e maquina de teste estavam na mesma regiao.
- Cenário k6: 100 usuários simultaneos durante 30 segundos.
- 1 pod apenas. Note que, dependendo do cenário, vai obter melhoria ampliando o numero de pods. Em outros não tanto.
  
## Resultados

Estes resultados servem apenas como parametros iniciais de comparação.

### Cpu

![image](https://github.com/user-attachments/assets/9ce8e0ce-c70a-4022-817d-1e11ce316f59)

![image](https://github.com/user-attachments/assets/0d6e19e2-8920-44e0-8c85-414836469dfe)

![image](https://github.com/user-attachments/assets/52efde88-5817-4b9e-b9da-5b00077d9ffb)

### Memoria

![image](https://github.com/user-attachments/assets/937b8a50-fa08-4628-b2ec-be1f98a20409)

![image](https://github.com/user-attachments/assets/7bc0593c-ae58-4c29-bff2-a3cc0ba2f499)

![image](https://github.com/user-attachments/assets/c8b7eee2-1939-44a2-9d14-5d20bbeb6d67)

![image](https://github.com/user-attachments/assets/023b1fc4-5514-4481-a0f6-f2c5997a80bd)


### Storage

* Graficos OpenShift de 19:04 a 19:08

![image](https://github.com/user-attachments/assets/4af12e18-f312-491b-bff1-4d914d76e169)

![image](https://github.com/user-attachments/assets/608f56d1-af36-45b8-94e2-90309edaf241)

![image](https://github.com/user-attachments/assets/2a73b83b-42e5-4874-ab3d-ce4bf90507ba)

![image](https://github.com/user-attachments/assets/88992d97-743f-4379-859a-6f41f23540e3)


### Database

* Graficos OpenShift de 10:15 a 10:20

![image](https://github.com/user-attachments/assets/bca0f22c-9a6e-44e6-b182-8f31b9ff5e98)

![image](https://github.com/user-attachments/assets/02390051-3e61-4af6-be99-41ce03de42f1)

![image](https://github.com/user-attachments/assets/392c314d-c029-4dc8-9f3f-ae55595d85ac)

![image](https://github.com/user-attachments/assets/efac79dc-6aa4-4916-ad3c-f881fc648885)

![image](https://github.com/user-attachments/assets/c2485cf4-fe83-4701-a852-272582643ff7)

OBS: Neste ultimo grafico, de I/O, desconsiderar o IO, uma vez que foi ainda resultado do teste anterior de Storage.

