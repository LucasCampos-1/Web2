# 🚗 Concessionária — CRUD Spring Boot

---

## 👤 Aluno

**Lucas Guilherme Ferreira Campos**

---

## 🛠️ Framework

**Java Spring Boot 3.2.5**

| Tecnologia | Versão |
|---|---|
| Java | 17+ |
| Spring Boot | 3.2.5 |
| Thymeleaf | 3.1.2 |
| Spring Data JPA | 3.2.5 |
| H2 Database | (in-memory) |
| Maven | 3.x |

---

## 📋 Sobre o Projeto

Sistema web de gerenciamento de uma concessionária com **CRUD completo** envolvendo duas entidades relacionadas:

- **Marca** — cadastro de marcas de veículos (ex: Toyota, Ford, Honda)
- **Veículo** — cadastro de veículos vinculados a uma marca

### Relacionamento
```
Marca (1) ──────────── (N) Veículo
```

---

## ⚙️ Pré-requisitos

Antes de rodar o projeto, certifique-se de ter instalado:

- [Java JDK 17+](https://www.oracle.com/java/technologies/downloads/)
- [Apache Maven 3.x](https://maven.apache.org/download.cgi)

Para verificar se estão instalados:
```bash
java -version
mvn -version
```

---

## 🚀 Como executar

**1. Clone o repositório**
```bash
git clone https://github.com/LucasCampos-1/Web2.git/
cd Web2/Concessionaria
```

**2. Execute o projeto**
```bash
mvn spring-boot:run
```

**3. Acesse no navegador**
```
http://localhost:8080/marcas
http://localhost:8080/veiculos
```

> O banco de dados H2 é criado automaticamente em memória — não precisa instalar nada!

---

## 📁 Estrutura do Projeto

```
src/main/
├── java/com/example/crud/
│   ├── controller/
│   │   ├── MarcaController.java
│   │   └── VeiculoController.java
│   ├── model/
│   │   ├── Marca.java
│   │   └── Veiculo.java
│   ├── repository/
│   │   ├── MarcaRepository.java
│   │   └── VeiculoRepository.java
│   ├── service/
│   │   ├── MarcaService.java
│   │   └── VeiculoService.java
│   └── Application.java
└── resources/
    ├── templates/
    │   ├── marcas/
    │   │   ├── list.html
    │   │   └── form.html
    │   └── veiculos/
    │       ├── list.html
    │       └── form.html
    └── application.properties
```

---

## 🔗 Rotas disponíveis

| Método | Rota | Descrição |
|---|---|---|
| GET | `/marcas` | Lista todas as marcas |
| GET | `/marcas/nova` | Formulário de nova marca |
| POST | `/marcas/salvar` | Salva uma marca |
| GET | `/marcas/editar/{id}` | Formulário de edição |
| GET | `/marcas/deletar/{id}` | Deleta uma marca |
| GET | `/veiculos` | Lista todos os veículos |
| GET | `/veiculos/novo` | Formulário de novo veículo |
| POST | `/veiculos/salvar` | Salva um veículo |
| GET | `/veiculos/editar/{id}` | Formulário de edição |
| GET | `/veiculos/deletar/{id}` | Deleta um veículo |