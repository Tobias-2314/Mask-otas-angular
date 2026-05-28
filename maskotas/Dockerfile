# ---- Build Stage ----
FROM gradle:8-jdk17-alpine AS builder
WORKDIR /app

COPY build.gradle .
COPY settings.gradle .
COPY src ./src

RUN gradle bootJar --no-daemon -x test

# ---- Run Stage ----
FROM eclipse-temurin:17-jre-alpine
WORKDIR /app

COPY --from=builder /app/build/libs/*.jar app.jar

EXPOSE 8090

ENTRYPOINT ["java", "-jar", "app.jar"]
