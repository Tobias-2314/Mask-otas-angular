package com.maskotas.controller;

import org.springframework.web.bind.annotation.*;
import java.util.Map;

@RestController
public class TestController {

    @GetMapping("/api/test-chat")
    public Map<String, String> testChat() {
        return Map.of("test", "ok");
    }
}
