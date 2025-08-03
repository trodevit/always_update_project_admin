
---
## 📚 API Documentation

---

### 🔹 Class-wise Endpoints

| Method | Endpoint            | Parameters                                                                                          | Description                                                                                      |
|--------|---------------------|-----------------------------------------------------------------------------------------------------|--------------------------------------------------------------------------------------------------|
| GET    | `/api/{type}`       | `type`: One of `suggestion`, `scholarship`, `result`, or `notice`                                  | Retrieves a list of items (`suggestion`, `scholarship`, `result`, or `notice`) grouped by class |
| GET    | `/api/{type}/{id}`  | `type`: One of `suggestion`, `scholarship`, `result`, or `notice` <br> `id`: Class ID (integer)   | Retrieves a single item (`suggestion`, `scholarship`, `result`, or `notice`) for the given class |

> ✅ Make sure `{type}` is one of the accepted values and `{id}` is a valid ID.
